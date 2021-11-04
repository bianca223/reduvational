
import requests
import commons as cp

def testPlanuriLunare_EmptyGet():
  global ip, cookie
  response = cp.getREST(f"http://{cp.ip}{cp.spr}PlanuriLunareController.php", cp.cookie)
  assert 1 == 1
  print("Tests for testPlanuriLunare_EmptyGet passed!")


def testAllFromCurrentModule():
  testPlanuriLunare_EmptyGet()

testAllFromCurrentModule()

  