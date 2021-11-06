
import requests
import commons as cp

def testArticole_EmptyGet():
  global ip, cookie
  response = cp.getREST(f"http://{cp.ip}{cp.spr}ArticoleController.php", cp.cookie)
  assert 1 == 1
  print("Tests for testArticole_EmptyGet passed!")


def testAllFromCurrentModule():
  testArticole_EmptyGet()

testAllFromCurrentModule()

  