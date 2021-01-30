#!/usr/bin/python
# -*- coding: utf-8 -*-

import RPi.GPIO as GPIO
import time
import sys

import logging

log_format = (
    '[%(asctime)s] %(levelname)-4s %(message)s'
)

logging.basicConfig(
    level=logging.DEBUG,
    format=log_format,
    filename=('/var/log/cpu-fan/cpu-fan.log'),
)

# Configuration
FAN_PIN = 2  # BCM pin used to drive transistor's base
WAIT_TIME = 1  # [s] Time to wait between each refresh
FAN_MIN = 0  # [%] Fan minimum speed.
PWM_FREQ = 100  # [Hz] Change this value if fan has strange behavior

# Configurable temperature and fan speed steps
tempSteps = [33, 35, 40]  # [°C]
speedSteps = [73, 73, 100]  # [%]

# Fan speed will change only of the difference of temperature is higher than hysteresis
hyst = 1

# Setup GPIO pin
GPIO.setmode(GPIO.BCM)
GPIO.setup(FAN_PIN, GPIO.OUT)
fan = GPIO.PWM(FAN_PIN, PWM_FREQ)
fan.start(0)

i = 0
cpuTemp = 0
fanSpeed = 0
cpuTempOld = 0
fanSpeedOld = 0

# We must set a speed value for each temperature step
if len(speedSteps) != len(tempSteps):
    print("Numbers of temp steps and speed steps are different")
    exit(0)

try:
    while 1:
        # Read CPU temperature
        cpuTempFile = open("/sys/class/thermal/thermal_zone0/temp", "r")
        cpuTemp = float(cpuTempFile.read()) / 1000
        cpuTempFile.close()

        # Calculate desired fan speed
        # logging.debug("New temp %s, old temp %s" % (cpuTemp, cpuTempOld))
        if abs(cpuTemp - cpuTempOld) > hyst:
            # Below first value, fan will run at min speed.
            if cpuTemp < tempSteps[0]:
                fanSpeed = speedSteps[0]
            # Above last value, fan will run at max speed
            elif cpuTemp >= tempSteps[len(tempSteps) - 1]:
                fanSpeed = speedSteps[len(tempSteps) - 1]
            # If temperature is between 2 steps, fan speed is calculated by linear interpolation
            else:
                for i in range(0, len(tempSteps) - 1):
                    if (cpuTemp >= tempSteps[i]) and (cpuTemp < tempSteps[i + 1]):
                        fanSpeed = round((speedSteps[i + 1] - speedSteps[i])
                                         / (tempSteps[i + 1] - tempSteps[i])
                                         * (cpuTemp - tempSteps[i])
                                         + speedSteps[i], 1)

            #logging.debug("Fan speed %s, old speed %s" % (fanSpeed, fanSpeedOld))
            if fanSpeed != fanSpeedOld:
                if (fanSpeed != fanSpeedOld
                        and (fanSpeed >= FAN_MIN or fanSpeed == 0)):
                    fan.ChangeDutyCycle(fanSpeed)
                    logging.info("Fan on @ %s, fan speed= %.2f" % (cpuTemp, fanSpeed))
                    fanSpeedOld = fanSpeed
            cpuTempOld = cpuTemp

        # Wait until next refresh
        time.sleep(WAIT_TIME)


finally:
    print("script exit")
    GPIO.cleanup()
    sys.exit()
