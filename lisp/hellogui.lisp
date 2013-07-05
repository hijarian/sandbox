(ql:quickload :cl-gtk2-gtk)

(defpackage :hello-world
  (:use :cl :gobject :gtk)
  (:export :main :run))

(in-package :hello-world)

(defun main ()
  (within-main-loop
    (let ((w (make-instance 'gtk-window :title "Hello, world"))
          (l (make-instance 'label :label "Hello, world!")))
      (container-add w l)
      (connect-signal w "destroy" (lambda (w)
                                    (declare (ignore w))
                                    (gtk-main-quit)))
      (widget-show w))))

(defun run ()
  (main)
  (join-main-thread))
