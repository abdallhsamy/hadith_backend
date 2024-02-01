#!/bin/bash

# MongoDB service name
MONGODB_SERVICE="mongod"

check_mongodb_status() {
    if systemctl is-active --quiet $MONGODB_SERVICE; then
        return 0  # MongoDB is running
    else
        return 1  # MongoDB is not running
    fi
}

# Function to restart MongoDB service
restart_mongodb() {
    systemctl restart $MONGODB_SERVICE
}

while true; do
    if ! check_mongodb_status; then
        echo "MongoDB is down. Restarting..."
        restart_mongodb
        echo "MongoDB restarted."
    fi

    sleep 60  # Sleep for 60 seconds before checking again
done


## to run in background mode use the following command in terminal : ./mongodb_monitor.sh &

## Author : Abdallah Samy
