#!/usr/bin/env python
import time
import Skype4Py
import random

print "                                                  ";
print "                                                  ";
print "      Bot by Bastian                                            ";
print "                                                  ";
print "                                                  ";
def commands(Message, Status):
  if Status == 'SENT' or (Status == 'RECEIVED'):
    
    if Message.Body == "!ping":
     cmd_ping(Message)
    
    elif Message.Body == "!rickroll":
     cmd_rickroll(Message)
    
    elif Message.Body == "!celebrate":
     cmd_celebrate(Message)
    
    elif Message.Body == "!hammertime":
     cmd_hammertime(Message)
    
    elif Message.Body == "!credit":
     cmd_credit(Message)
    
    elif Message.Body == "!help":
     cmd_help(Message)
    
    elif Message.Body == "!spam":
     cmd_spam(Message)
    
    elif Message.Body == "!introduce":
     cmd_intro(Message)
    
    elif Message.Body == '!dice':
     cmd_dice(Message)
    
    else:
     pass

  else:
    pass

def cmd_ping(Message):
  Message.Chat.SendMessage('Yes, I\'m still alive. :)')
  print "Ping Command Received \n"

def cmd_rickroll(Message):
  Message.Chat.SendMessage(' Never Gonna Give You Up! \o/')
  time.sleep(0.5)
  Message.Chat.SendMessage(' Never Gonna Let You Down! \o/')
  time.sleep(0.5)
  Message.Chat.SendMessage(' Never Gonna Run Around and Desert You! \o/')
  time.sleep(0.5)
  Message.Chat.SendMessage(' Never Gonna Make You Cry! \o/')
  time.sleep(0.5)
  Message.Chat.SendMessage(' Never Gonna Say Goodbye! \o/')
  time.sleep(0.5)
  Message.Chat.SendMessage(' Never Gonna Tell A Lie! \o/')
  time.sleep(0.5)
  Message.Chat.SendMessage(' Or Hurt You! \o/')
  time.sleep(0.5)
  print "Rick Command Received.\n"

def cmd_celebrate(Message):
  Message.Chat.SendMessage(' Good job!')
  time.sleep(1)
  Message.Chat.SendMessage(' You did great!')
  time.sleep(1)
  Message.Chat.SendMessage(' Keep up the good work!')
  time.sleep(1)
  Message.Chat.SendMessage(' (clap)')
  print "Celebrate Command Received.\n"
    
def cmd_hammertime(Message):
  Message.Chat.SendMessage(' EVERYONE!')
  time.sleep(1)
  Message.Chat.SendMessage(' EVERYONE STOP WHAT YOU\'RE DOING!')
  time.sleep(1)
  Message.Chat.SendMessage(' DO YOU GUYS EVEN KNOW WHAT TIME IT IS!?!?!?!?!?')
  time.sleep(1)
  Message.Chat.SendMessage(' HAMMERTIME!!!!!!!! \o/')
  print "Hammer time Command Received.\n"

def cmd_credit(Message):
  Message.Chat.SendMessage(' Hi, its me.')
  Message.Chat.SendMessage(' Everything on me was made by Bastian.')
  Message.Chat.SendMessage(' If you want to further develop me, just ask Bastian')
  print "Credit Command Received.\n"

def cmd_help(Message):
  Message.Chat.SendMessage(' Type !ping to see if the bot is alive!')
  Message.Chat.SendMessage(' Type !celebrate to have a party!')
  Message.Chat.SendMessage(' Type !rickroll to rick roll someone!')
  Message.Chat.SendMessage(' Type !hammertime to stop, drop, and hammertime!')
  Message.Chat.SendMessage(' Type !credit to see who made me!')
  Message.Chat.SendMessage(' Type !spam for some yummy spam!')
  Message.Chat.SendMessage(' Type !dice for a fun game!')
  print 'Help Command Recieved.\n'

def cmd_spam(Message):
  print 'Spam Command Recieved.\n'
  while True:
    Message.Chat.SendMessage('I love Spam :)')

def cmd_intro(Message):
  Message.Chat.SendMessage(' Hi!')
  time.sleep(2)
  Message.Chat.SendMessage(' I just want to be annoying.')
  time.sleep(2)
  Message.Chat.SendMessage(' Techincally, I\'m a robot!')
  time.sleep(2)
  Message.Chat.SendMessage(' Type !help to see what I can do. :)')
  print "Introduce Command Received.\n"

def cmd_dice(Message):
  Message.Chat.SendMessage(' Put a bet on numbers 1 through 6.')
  time.sleep(music)
  answer = random.randint(1,6)
  Message.Chat.SendMessage(' *rolls dice*')
  time.sleep(1)
  Message.Chat.SendMessage(' The dice rolled the number:')
  Message.Chat.SendMessage(answer)
  print "Someone's playing dice. \n"

skype = Skype4Py.Skype();
skype.OnMessageStatus = commands

if skype.Client.IsRunning == False:
    skype.Client.Start()
skype.Attach();

print 'Skype Bot currently running on user',skype.CurrentUserHandle, "\n"

while True:
    raw_input('')