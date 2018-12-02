#include <stdio.h>
#include <string.h>

int main () {
	
	char str[10];
	char a[10];
    char b[10];

	fgets(str,9,stdin);
	str[strlen(str)-1] = '\0';
	sscanf(str, "%s %[^\n]",a, b);
	printf("%d\n",atoi(a)+atoi(b));

	return 0;
}