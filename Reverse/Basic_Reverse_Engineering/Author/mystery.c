#include <stdio.h>
#include <string.h>

void secret_function() {
    printf("Congratulations! Here is your flag: shellmateCTF{R3vers1ng_1s_C00l}\n");
}

int main() {
    char password[32];

    printf("Enter the secret passcode: ");
    scanf("%s", password);

    if (strcmp(password, "shellmate") == 0) {
        secret_function();
    } else {
        printf("Wrong password! Try again.\n");
    }

    return 0;
}
