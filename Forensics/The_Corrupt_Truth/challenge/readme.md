# The Corrupt Truth 

**Category:** Forensics
**Difficulty:** easy

### **Description**
A strange image has been discovered, but something isn’t quite right…  
The image appears corrupted and won’t open properly.  
Even if you recover it, there’s more than meets the eye.  

Your mission is to extract all hidden flag pieces and reconstruct the full flag.  

## **Flag Format**
`shellmateCTF{...}`  

---

## **Hints**
1. **Some things leave traces… even in metadata.**  
   - Inspect the metadata of the image file. Tools like `exiftool` or `strings` might help.  

2. **A file header is more important than you think.**  
   - The image might be corrupted due to an altered header. Check the magic bytes using a hex editor.  

3. **Look closely at the image and its colors!**  
   - There may be clues hidden within the image, such as steganographic techniques or color anomalies.  

4. **There may be something extra hidden inside.**  
   - The file might contain additional embedded data. Try extracting it with `binwalk`, `foremost`, or `steghide`.  

---

## **Objective**
1. Recover the corrupted image if necessary.
2. Extract all hidden flag pieces.
3. Combine them to reconstruct the full flag.
4. Submit the final flag in the format:  
   **`shellmateCTF{...}`**  

---

## **Notes**
- The flag might be divided into different parts, each hidden in different ways.
- Some parts may be inside metadata, some in hidden layers, and some embedded in the file itself.
- Carefully analyze every aspect of the file before jumping to conclusions!

---

**Good luck, and happy hunting!**
