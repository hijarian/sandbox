;;;;#!/home/hijarian/bin/sbcl-loaded --script

(ql:quickload :qt)

(defpackage :my-texted
  (:use :cl :qt)
  (:export #:main))

(in-package :my-texted)
(enable-syntax)

(defun main ()
  (let* ((app (make-qapplication))
         (editor (#_new QTextEdit)))
    (#_show editor)
    (unwind-protect
         (#_exec app)
      (#_hide editor))))

