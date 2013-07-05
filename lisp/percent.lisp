(defun percent (amount multiplier addition period)
	"Получить количество денег на итерации period, если изначально их было amount, и на каждой итерации к имеющемуся количеству прибавляется addition и полученное значение умножается на multiplier"
	(if (= period 0)
		amount
		(percent (* multiplier (+ amount addition)) multiplier addition (1- period))))

(defun my-percent (period)
	(percent 0 1.05 2000 period))

