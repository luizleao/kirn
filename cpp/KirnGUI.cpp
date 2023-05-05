#include <windows.h>
//Definimos um nome para os controles
#define t_1 1
#define r_1 2
#define r_2 3

//HWND dos controles
HWND txt;
HWND radio1,radio2;

LRESULT CALLBACK WinProc(HWND window,UINT msg, WPARAM wParam,LPARAM lParam);

int WINAPI WinMain(HINSTANCE hInstance,HINSTANCE hPrevInstance,LPSTR lpCmdLine, int nShowCmd){
	MSG message;
	HWND hwnd;
	WNDCLASSEX wc;
	wc.cbClsExtra=0;
	wc.cbSize=sizeof(wc);
	wc.cbWndExtra=0;
	wc.hbrBackground=GetSysColorBrush(COLOR_BTNFACE);
	wc.hCursor=LoadCursor(NULL,IDC_ARROW);
	wc.hIcon=LoadIcon(NULL,IDI_APPLICATION);
	wc.hIconSm=LoadIcon(NULL,IDI_APPLICATION);
	wc.lpfnWndProc=WinProc;
	wc.lpszClassName="Janela";
	wc.lpszMenuName=NULL;
	wc.style=0;
	RegisterClassEx(&wc);
	hwnd = CreateWindowEx(0,"Janela","EXEMPLO 1",WS_OVERLAPPED|WS_SYSMENU,200,200,400,120,NULL,NULL,NULL,NULL);
	ShowWindow(hwnd,SW_SHOW);
	UpdateWindow(hwnd);
	while(GetMessage(&message,0,0,0)){
		TranslateMessage(&message);
		DispatchMessage(&message);
	}
	return message.wParam;	
}

LRESULT CALLBACK WinProc(HWND window,UINT msg, WPARAM wParam,LPARAM lParam){
	switch(msg){
		case WM_CLOSE:
			PostQuitMessage(0);
		break;
	
		case WM_CREATE: //No processo de criação da janela
			txt = CreateWindowEx(0,"EDIT","" ,WS_CHILD|WS_VISIBLE|WS_BORDER,10,10,370,20,window,(HMENU)t_1,0,0); //Cria nosso textbox
			radio1 = CreateWindowEx(0,"BUTTON","Obter nome do usuário",WS_CHILD|WS_VISIBLE|BS_AUTORADIOBUTTON,10,50,240,15,window,(HMENU)r_1,0,0); //Cria o primeiro radiobutton
			radio2 = CreateWindowEx(0,"BUTTON","Sair do programa" ,WS_CHILD|WS_VISIBLE|BS_AUTORADIOBUTTON,240,50,240,15,window,(HMENU)r_2,0,0); //Cria o segundo
		break;
		
		case WM_COMMAND: //Mensagem enviada quando se clica em um controle
			switch(wParam){ //Verifica o parâmetro
				case r_1: //Caso seja o primeiro radiobutton
					
					//Obtém o nome do usuírio   
					char buffer[256];
					DWORD size;
					size=256;
					GetUserName(buffer,&size);
					SetWindowText(txt,buffer); //Mostra no textbox
				break;
				case r_2: //Caso seja o segundo
					ExitProcess(0); //Encerra
	 		} 
		break;
		default:
			return DefWindowProc(window,msg,wParam,lParam);
	}
	return 0;
}
