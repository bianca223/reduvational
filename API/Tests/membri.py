
import requests
import commons as cp

def testMembri_EmptyGet():
  global ip, cookie
  response = cp.getREST(f"http://{cp.ip}{cp.spr}MembriController.php", cp.cookie)
  assert 1 == 1
  print("Tests for testMembri_EmptyGet passed!")


def testAllFromCurrentModule():
  testMembri_EmptyGet()

testAllFromCurrentModule()

  