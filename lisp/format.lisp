(defparameter *list* '(a b c d e f g h i))

(loop for cons on *list*
     do (format t "~a" (car cons))
     when (cdr cons) do (format t ", "))

(format t "~{~a~^, ~}" *list*)

