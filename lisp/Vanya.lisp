(defun f (x)
  (/ (cos x) (+ x 1)))

(loop for i from 6 to 14 by 1 do
     (format T "f(~f) = ~a~%" (/ i 10) (f (/ i 10))))

(defun g (x)
  (/ 1 (sqrt (+ (* x x) 1))))

(loop for i from 200 to 1200 by 125 do
     (format T "g(~f) = ~a~%" (/ i 1000) (g (/ i 1000))))
