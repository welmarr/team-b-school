#!/bin/bash

# Define the label selector to find the pod
LABEL_SELECTOR="app=laravel-app"

# Function to wait for a specific pod to be running with a timeout of 10 minutes
wait_for_pod_running() {
  POD_NAME=$1
  TIMEOUT=600  # 600 seconds = 10 minutes
  START_TIME=$(date +%s)

  while true; do
    CURRENT_TIME=$(date +%s)
    ELAPSED_TIME=$((CURRENT_TIME - START_TIME))

    POD_STATUS=$(kubectl get pod $POD_NAME --output=jsonpath='{.status.phase}')

    if [ "$POD_STATUS" == "Running" ]; then
      echo "Pod $POD_NAME is running."
      return 0
    elif [ "$ELAPSED_TIME" -ge "$TIMEOUT" ]; then
      echo "Timed out waiting for pod $POD_NAME to be in Running state."
      return 1
    else
      echo "Waiting for pod $POD_NAME to be in Running state... ($ELAPSED_TIME seconds elapsed)"
      sleep 2
    fi
  done
}

# Get all pods matching the label selector
PODS=$(kubectl get pods --selector=$LABEL_SELECTOR --sort-by=.metadata.creationTimestamp --output=jsonpath='{range .items[*]}{.metadata.name}{" "}{.status.phase}{" "}{.metadata.creationTimestamp}{"\n"}{end}')

# Count the number of pods
POD_COUNT=$(echo "$PODS" | wc -l)

if [ "$POD_COUNT" -eq 1 ]; then
  # If there's only one pod, wait for it to be running
  POD_NAME=$(echo "$PODS" | awk '{print $1}')
  if wait_for_pod_running $POD_NAME; then
    CONTAINER_NAME=$(kubectl get pod $POD_NAME --output=jsonpath='{.spec.containers[0].name}')
    echo "Pod Name: $POD_NAME"
    echo "Container Name: $CONTAINER_NAME"
    kubectl exec -it po/$POD_NAME --container=$CONTAINER_NAME -- sh -c "nohup /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf &"
  fi
else
  # If there are multiple pods, wait for 3 minutes and check again
  echo "Multiple pods detected. Waiting for 3 minutes..."
  sleep 180  # 3 minutes
  NEW_PODS=$(kubectl get pods --selector=$LABEL_SELECTOR --sort-by=.metadata.creationTimestamp --output=jsonpath='{range .items[*]}{.metadata.name}{" "}{.status.phase}{" "}{.metadata.creationTimestamp}{"\n"}{end}')
  NEW_POD_COUNT=$(echo "$NEW_PODS" | wc -l)

  if [ "$NEW_POD_COUNT" -eq 1 ]; then
    POD_NAME=$(echo "$NEW_PODS" | awk '{print $1}')
    echo "Only one pod remaining. Proceeding with command execution."
    CONTAINER_NAME=$(kubectl get pod $POD_NAME --output=jsonpath='{.spec.containers[0].name}')
    echo "Pod Name: $POD_NAME"
    echo "Container Name: $CONTAINER_NAME"
    kubectl exec -it po/$POD_NAME --container=$CONTAINER_NAME -- sh -c "nohup /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf &"
  else
    # Find the youngest pod (smallest age)
    YOUNGEST_POD=$(echo "$NEW_PODS" | head -n 1 | awk '{print $1}')
    echo "Multiple pods are still running. The youngest pod is $YOUNGEST_POD."
    echo "Please manually execute the following command in the youngest pod's container:"
    echo "kubectl exec -it po/$YOUNGEST_POD --container=$(kubectl get pod $YOUNGEST_POD --output=jsonpath='{.spec.containers[0].name}') -- sh -c \"nohup /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf &\""
  fi
fi
