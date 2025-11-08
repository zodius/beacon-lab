#include <stdio.h>
#include <stdlib.h>
#include <sys/mman.h>
#include <string.h>

// get_shellcode read a shellcode from file and return it as a string
char* get_shellcode(const char* filename);
// execute_shellcode executes the given shellcode
void execute_shellcode(char* shellcode);

int main() {
    char* shellcode = get_shellcode("shellcode.txt");
    if (shellcode == NULL) {
        return 1;
    }

    execute_shellcode(shellcode);
    free(shellcode);

    return 0;
}

char* get_shellcode(const char* filename) {
    FILE* file = fopen(filename, "r");
    if (file == NULL) {
        perror("Failed to open file");
        return NULL;
    }

    fseek(file, 0, SEEK_END);
    long length = ftell(file);
    fseek(file, 0, SEEK_SET);

    char* shellcode = (char*)malloc(length + 1);
    if (shellcode == NULL) {
        perror("Failed to allocate memory");
        fclose(file);
        return NULL;
    }

    fread(shellcode, 1, length, file);
    shellcode[length] = '\0';

    fclose(file);
    return shellcode;
}

void execute_shellcode(char* shellcode) {
    // allocate an executable memory region
    void *exec = mmap(0, strlen(shellcode), PROT_READ | PROT_WRITE | PROT_EXEC,
                      MAP_ANONYMOUS | MAP_PRIVATE, -1, 0);
    if (exec == MAP_FAILED) {
        perror("mmap");
        return;
    }

    // copy shellcode to the executable memory region
    memcpy(exec, shellcode, strlen(shellcode));

    // execute the shellcode
    ((void(*)())exec)();
}