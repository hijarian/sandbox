#!/bin/bash
for i in {5..25}
do
	mv data temp
	sed -e "s/^.*$/$i/" temp > data
	clisp euler12.cl data
done
