#include <stdio.h>
#include <stdlib.h>
#include <string.h>

void win() {
    printf("You have successfully exploited the buffer overflow!\n");
    system("cat flag.txt");
}

void vuln() {
    char buffer[32]; 
    printf("Enter your input: ");
    gets(buffer); 
}

int main() {
    vuln();
    printf("Exiting program...\n");
    return 0;
}
