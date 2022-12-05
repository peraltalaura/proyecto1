# Pulling Ubuntu image
FROM ubuntu:20.04

# Updating packages and installing cron
RUN apt-get update && apt-get install cron -y 
RUN apt-get -y install python3-pip
RUN pip install ipython
RUN pip install nbformat
RUN pip install pymysql
RUN apt-get install nano
RUN pip install cryptography
RUN pip install secure-smtplib

# Copying script file into the container.
COPY db_connect.ipynb .
COPY send_mail_weekly.sh .

# Giving executable permission to the script file.
RUN chmod +x send_mail_weekly.sh
RUN chmod +x db_connect.ipynb

# Adding crontab to the appropiate location
ADD crontab /etc/cron.d/my-cron-file

# Giving executable permission to crontab file
RUN chmod 0644 /etc/cron.d/my-cron-file

# Running crontab
RUN crontab /etc/cron.d/my-cron-file

# Creating entry point for cron 
ENTRYPOINT ["cron", "-f"]

