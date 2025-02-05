# XOR Cipher Mystery

**Category:** cryptography
**Difficulty:** Medium

### **Description**
The flag has been XOR-encrypted using a **3-character repeating key**. Can you recover the original flag? 

You are given an encrypted message in `encrypted.txt`. Your mission is to **decrypt it**.

---

## **Flag Format**
`shellmateCTF{...}`  

---

### **Ciphertext (Hex-encoded)**
7b 11 06 3f 3f 12 57 1d 0b 58 4b 0b 06 0f 44 1d 11 12 44 06 1d

---

### **Hints**
- The encryption used **XOR with a repeating key**.
- The key is **three characters long**.
- The flag format is **`shellmateCTF{...}`**.

---

### **Files Provided**
- `encrypted.txt`: The XOR-encrypted message.

---

### **Goal**
Recover the original flag and submit it!

---

### **Rules**
- Do not brute-force the server (if applicable).
- The flag format is `CTF{...}`, so look for patterns in decryption.
- Have fun and learn something new!