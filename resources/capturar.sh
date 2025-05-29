#!/bin/bash

# Interface de rede (pode ser substituída por argumento)
INTERFACE=${1:-eth0}
DURACAO=${2:-10}  # tempo em segundos

# Comando tshark
tshark -i "$INTERFACE" -a duration:"$DURACAO" -T fields \
  -e ip.src -e ip.dst -e _ws.col.Protocol -e frame.len \
  -E separator=, -E quote=d -E header=n \
  | grep -v '^""'  # Remove linhas vazias
