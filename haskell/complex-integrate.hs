import Data.Complex.Integrate

main = do
	print $ integrate (+ 0) 10 0 100
	return ()
