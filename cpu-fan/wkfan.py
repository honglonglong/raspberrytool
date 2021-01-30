#!/usr/bin/env python
# encoding: utf-8
# From:shumeipai.net
# 设定阀值启动关闭代码
import RPi.GPIO
import time

start = 40
stop = 35

RPi.GPIO.setwarnings(False)
RPi.GPIO.setmode(RPi.GPIO.BCM)
RPi.GPIO.setup(2, RPi.GPIO.OUT)
pwm = RPi.GPIO.PWM(2,100)
fan = False

try:
	while True:
		with open('/sys/class/thermal/thermal_zone0/temp') as f:
			cur = int(f.read()) / 1000
		now = time.strftime("%H:%M:%S",time.localtime(time.time()))
		if not fan and cur >= start:
			pwm.start(100)
			fan = True
			print("[%s] Fan on @ %s" % (now, cur))
		if fan and cur <= stop:
			pwm.stop()
			fan = False
			print("[%s] Fan off @ %s" % (now, cur))
		time.sleep(1)
except KeyboardInterrupt:
	pwm.stop()