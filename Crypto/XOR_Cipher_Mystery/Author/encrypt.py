import os

def xor_encrypt(plaintext, key):
    return bytes([plaintext[i] ^ key[i % len(key)] for i in range(len(plaintext))])

flag = b"shellmateCTF{X0R_1s_f7n}"  
key = b"XYZ"  # 3-character key

ciphertext = xor_encrypt(flag, key)

# Save ciphertext in hex format
with open("encrypted.txt", "w") as f:
    f.write(" ".join(f"{byte:02x}" for byte in ciphertext))

print("Encryption complete! Ciphertext saved to encrypted.txt")
