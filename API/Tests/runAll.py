
import os

files = [f for f in os.listdir('.') if os.path.isfile(f)]
for cf in files:
  if cf not in "runAll.py" and cf not in "commons.py":
    print("File " + cf)
    os.system("python " + cf)
  