import os
from itertools import product

current_dir = os.path.dirname(os.path.abspath(__file__))
file_path = os.path.join(current_dir, "encrypted.txt") 

def xor_decrypt(ciphertext, key):
    return bytes([ciphertext[i] ^ key[i % len(key)] for i in range(len(ciphertext))])

with open(file_path, "r") as f: 
    ciphertext = bytes.fromhex(f.read().replace(" ", ""))

# Brute-force all possible 3-character keys (print only meaningful results)
for key in product(range(32, 127), repeat=3):  # ASCII printable chars
    key = bytes(key)
    decrypted = xor_decrypt(ciphertext, key)
    
    if b"CTF{" in decrypted: 
        print(f"Key found: {key.decode()} -> Decrypted message: {decrypted.decode()}")
        break
