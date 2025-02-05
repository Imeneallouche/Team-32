import requests
from PIL import Image, ImageDraw, ImageFont
import qrcode
import os

## CTF FLAG: shellmateCTF{h1dd3n_1nf0rm4t1on_inside_4n_1m4g3_g00d_luck}
FLAG_PART_1 = "part 1/4 : shellmateCTF{h1d"     # Hidden in EXIF Metadata
FLAG_PART_2 = "part 2/4 : d3n_1nf0rm4t1on_"      # Hidden in QR Code
FLAG_PART_3 = "part 3/4 : inside_4n_1m4g3_"      # Hidden as Invisible Yellow Text
FLAG_PART_4 = "part 4/4 : g00d_luck}"            # Hidden as Binary Data in Image

## Step 1️:
# Convert to PNG for transparency support
img = Image.open("shellmate.png").convert("RGBA")
img.save("clean_image.png")
print("✅ Image converted to PNG.")

## Step 2: Hide QR Code 
qr = qrcode.QRCode(box_size=4, border=0)
qr.add_data(FLAG_PART_2)
qr.make(fit=True)

qr_img = qr.make_image(fill="black", back_color="white").convert("RGBA")
qr_resized = qr_img.resize((60, 60))  # Small QR code

img = Image.open("clean_image.png")
img.paste(qr_resized, (img.width - 80, img.height - 80), qr_resized)
img.save("image_with_qr.png")
print("✅ Part 2 of flag hidden as a QR code.")

## Step 3️: Hide Invisible Text in **Yellow**
img = Image.open("image_with_qr.png")
draw = ImageDraw.Draw(img)
font = ImageFont.load_default()

draw.text((10, 10), FLAG_PART_3, fill=(247, 237, 85, 250), font=font)
img.save("image_with_text.png")
print("✅ Part 3 of flag hidden as faint yellow text.")

## Step 4️: Hide Binary Data in Image Properly
with open("hidden_binary.txt", "w") as f:
    f.write(FLAG_PART_4)

# Append binary data to image file correctly
os.system("dd if=hidden_binary.txt of=image_with_text.png bs=1 seek=$(stat -c%s image_with_text.png) > /dev/null 2>&1")
os.rename("image_with_text.png", "hidden_image.png")
os.remove("hidden_binary.txt")

print("✅ Part 4 of flag hidden as binary data in 'hidden_image.png'.")

## Step 5️: Inject EXIF Metadata Using exiftool
exif_metadata_command = f'exiftool -overwrite_original -Artist="{FLAG_PART_1}" hidden_image.png'
os.system(exif_metadata_command)

print("✅ EXIF metadata added manually using exiftool.")
print("\n🎯 Challenge complete! The flag is fully hidden in 'hidden_image.png'.")
