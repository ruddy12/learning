import csv

import smtplib

from email.mime.text import MIMEText

import re

fp = open('message.txt', 'rb')
msg = MIMEText(fp.read())
fp.close()
msg['Subject'] = 'bulk email test'
msg['From'] = 'rufusngash@gmail.com'

server = smtplib.SMTP('smtp.gmail.com:587')
server.starttls()
server.login('rufusngash@gmail.com', '80528052')
email_data = csv.reader(open('email.csv', 'rb'))
email_pattern= re.compile("^.+@.+\..+$")
for row in email_data:
  if( email_pattern.search(row[1]) ):
    del msg['To']
    msg['To'] = row[1]
    try:
      server.sendmail('test@gmail.com', [row[1]], msg.as_string())
    except SMTPException:
      print ("An error occured.")
server.quit()