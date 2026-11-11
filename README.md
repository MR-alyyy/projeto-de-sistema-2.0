# projeto-de-sistema

## Envio de e-mail do bibliotecário

O envio usa o PHPMailer e o SMTP do Gmail. No diretório do projeto, instale a dependência:

```powershell
composer install
```

Configure `SMTP_USERNAME` como `aly.matheus2342@gmail.com` e `SMTP_PASSWORD` com uma senha de app válida, como variáveis de ambiente do sistema que inicia o Apache. Revogue a senha de app compartilhada na conversa e gere outra antes de configurar. Não coloque a senha no HTML, no repositório ou em arquivos servidos pelo site. Depois de configurar as variáveis, reinicie o Apache e acesse a página pelo XAMPP/Apache (não abra o HTML diretamente como arquivo). A opção **Mandar e-mail** envia uma mensagem de teste e exige uma sessão autenticada de bibliotecário. A opção **Formulário** é apenas local: exibe no navegador os dados preenchidos, incluindo o relato inicial sobre a porta 9651 e o e-mail que não funciona, sem enviar nada.