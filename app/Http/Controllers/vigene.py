def vigenere_encrypt(plaintext, keyword):
    ciphertext = ""
    keyword_repeat = (keyword * (len(plaintext) // len(keyword) + 1))[:len(plaintext)]
    for p, k in zip(plaintext, keyword_repeat):
        shift = (ord(p) - ord('A') + ord(k) - ord('A')) % 26
        ciphertext += chr(shift + ord('A'))
    return ciphertext

print(vigenere_encrypt("vicent", "KEY"))  # Output: RIJVS
