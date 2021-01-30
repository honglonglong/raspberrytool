#!/usr/bin/env python
# encoding: utf-8
# 随温度变化，自动控制风扇转速代码

import RPi.GPIO
import time
import math

import logging

log_format = (
    '[%(asctime)s] %(levelname)-8s %(name)-12s %(message)s'
)

logging.basicConfig(
    level=logging.DEBUG,
    format=log_format,
    filename=('/var/log/cpu-fan/cpu-fan.log'),
)

RPi.GPIO.setwarnings(False)
RPi.GPIO.setmode(RPi.GPIO.BCM)
RPi.GPIO.setup(2, RPi.GPIO.OUT)
pwm = RPi.GPIO.PWM(2,100)
RPi.GPIO.setwarnings(False)


speed = 0
prv_temp = 0


try:
	while True:
	
		tmpFile = open( '/sys/class/thermal/thermal_zone0/temp' )
		cpu_temp = int(tmpFile.read())
		tmpFile.close()
		if cpu_temp>=36500 :
		
			if prv_temp<34500 :
			#启动时防止风扇卡死先全功率转0.1秒
				pwm.start(0)
				pwm.ChangeDutyCycle(100)
				time.sleep(1)
			speed = min( cpu_temp/125-237 , 100 )
			
			#将风扇速度分成几个档，不喜欢风扇速度变得变去的，声音太起伏。
			speed = math.ceil(speed/10)*10
			pwm.ChangeDutyCycle(speed)
		else :
			pwm.stop()
		prv_temp = cpu_temp
		#now = time.strftime("%H:%M:%S",time.localtime(time.time()))
		#print("[%s] Fan on @ %s, fan speed= %.2f" % (now, cpu_temp/1000, speed))
		logging.info("Fan on @ %s, fan speed= %.2f" % (cpu_temp/1000, speed))
		time.sleep(5)
				
except KeyboardInterrupt:
	pass
pwm.stop()