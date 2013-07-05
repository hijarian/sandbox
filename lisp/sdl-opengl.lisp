(ql:quickload :lispbuilder-sdl)
(ql:quickload :cl-opengl)

(defpackage :sdl-opengl
  (:use :lispbuilder-sdl :cl-opengl :common-lisp))

(in-package :sdl-opengl)


(defun opengl-test-1 ()
  (sdl:with-init ()
    (sdl:window 250 250
                :title-caption "OpenGL Example"
                :icon-caption "OpenGL Example"
                :opengl t
                :opengl-attributes '((:SDL-GL-DOUBLEBUFFER 1)))
    (gl:clear-color 0 0 0 0)
    ;; Initialize viewing values.
    (gl:matrix-mode :projection)
    (gl:load-identity)
    (gl:ortho 0 1 0 1 -1 1)
    (sdl:with-events ()
      (:quit-event () t)
      (:idle ()
       (gl:clear :color-buffer-bit)
       ;; Draw white polygon (rectangle) with corners at
       ;; (0.25, 0.25, 0.0) and (0.75, 0.75, 0.0).
       (gl:color 1 1 1)
       (gl:with-primitive :polygon
                          (gl:vertex 0.25 0.25 0)
                          (gl:vertex 0.75 0.25 0)
                          (gl:vertex 0.75 0.75 0)
                          (gl:vertex 0.25 0.75 0))
       ;; Start processing buffered OpenGL routines.
       (gl:flush)
       (sdl:update-display)))))
