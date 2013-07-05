(defvar *account-numbers* 0)

(defclass bank-account ()
  ((customer-name
    :initarg :customer-name
    :initform (error "Необходимо указать имя клиента!")
;;;    :reader customer-name
;;;    :writer (setf customer-name)
    :accessor customer-name ;shortcut for both reader&writer
    :documentation "Customer's name")
   (balance
    :initarg :balance
    :initform 0
    :reader balance
    :documentation "Current account balance")
   (account-number
    :initform (incf *account-numbers*)
    :reader account-number
    :documentation "Account number, unique within a bank")
   (account-type
    :reader account-type
    :documentation "Type of account, one of :gold, :silver, or :bronze.")))

(defmethod initialize-instance :after ((account bank-account) &key opening-bonus-percentage)
  (let ((balance (slot-value account 'balance)))
    (setf (slot-value account 'account-type)
          (cond
            ((>= balance 100000) :gold)
            ((>= balance 50000) :silver)
            (t :bronze))))
  (when opening-bonus-percentage
    (incf (slot-value account 'balance)
          (* (slot-value account 'balance)
             (/ opening-bonus-percentage 100)))))

(defparameter *account*
  (make-instance 'bank-account :customer-name "John Doe" :balance 1000))

(defun new-acc (money &optional (name "John Doe"))
  (make-instance 'bank-account :customer-name name :balance money))

(defgeneric balance (account))

(defmethod balance ((account bank-account))
  (slot-value account 'balance))

(defgeneric (setf customer-name) (value account))

(defmethod (setf customer-name) (value (account bank-account))
  (setf (slot-value account 'customer-name) value))

(defgeneric customer-name (account))

(defmethod customer-name ((account bank-account))
  (slot-value account 'customer-name))

(defgeneric assess-low-balance-penalty (account))

(defparameter *minimum-balance* 100)

(defmethod assess-low-balance-penalty ((account bank-account))
  (with-slots ((bal balance)) account
    (when (< bal *minimum-balance*)
      (decf bal (* bal .01)))))

(defmethod merge-accounts ((account1 bank-account) (account2 bank-account))
  (with-accessors ((balance1 balance)) account1
    (with-accessors ((balance2 balance)) account2
      (incf balance1 balance2)
      (setf balance2 0))))

