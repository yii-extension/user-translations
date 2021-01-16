#!/bin/bash

for i in locales/*/*.po; do
    newDIR=$(dirname "$i")"/LC_MESSAGES/"
    mkdir -p "$newDIR"
    msgfmt --use-fuzzy --output-file="$newDIR/"$(basename "$i" .po)".mo" "$i"
done
