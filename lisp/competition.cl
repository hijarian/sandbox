#!/usr/bin/sbcl --script

;;Calculates number of divisors
(defun divisor-number (number)
  (if (> number 1)
      (let ((m (floor (sqrt number)))
	    (nmb 1))
	(dotimes (i (1- m))
	  (if (eq (rem number (+ i 2)) 0)
	      (incf nmb)
	      nil))
	(* nmb 2))
      1))

;; Calculates needed triangle number based on supplied criteria
(defun needed-triangle-number (next-addend trnmb needed-divisors)
  "Computes needed triangle number. Start it with (needed-triangle-number 2 1 needed-divisors)!"
  (let ((n (divisor-number trnmb)))
    (if (> n needed-divisors)
	trnmb
	(needed-triangle-number (1+ next-addend) (+ trnmb next-addend) needed-divisors)))) 

(defun my-command-line ()
  (or 
   #+CLISP *args*
   #+SBCL *posix-argv*  
   #+LISPWORKS system:*line-arguments-list*
   #+CMU extensions:*command-line-words*
   nil))

(defun my-filename ()
  (car (last (my-command-line))))

(with-open-file (stream (my-filename))
    (let ((value (read-from-string (read-line stream))))
      (format T "~D~%" (needed-triangle-number 2 1 value))))

