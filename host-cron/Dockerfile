# Pulling Alpine image
FROM alpine:latest

# Setting up work directory
WORKDIR /cron

# Updating the packages
#RUN apk update && \
#apk upgrade --available && sync && \

# Copy script file into container.
COPY db_connect.ipynb .
COPY send_mail_weekly.sh .

# Giving executable permission to script file.
RUN chmod +x send_mail_weekly.sh
