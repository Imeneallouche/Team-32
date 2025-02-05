# Buffer Overflow Challenge

**Category:** Binary Exploitation  
**Difficulty:** Medium  

---

## **📝 Description**
A simple program takes user input, but it **does not check input size** before writing to memory. Can you **exploit this buffer overflow** to get the flag?

---

## **🎯 Your Goal**
- Exploit the **buffer overflow**.
- Redirect execution to **call `win()`**.
- Read the **flag from `flag.txt`**.

---

## **🚀 How to Run the Challenge**
1. **Compile the program (if not provided precompiled):**
   ```sh
   make
