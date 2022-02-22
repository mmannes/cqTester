# cqTester
Convenções para executar testes remotos em PHP

Na raiz do projeto crie um diretório chamado `tests` e adicione seus arquivos de testes dentro. Os arquivos devem inicar com o nome `test` para que o executor saiba qual arquivo deve ser executado.

Dentro do diretório `tests` clone este repositório com o comando:
> git clone https://github.com/mmannes/cqTester .

Para conseguir rodar os testes diretamente no Visual Studio Code copie o arquivo `launch.json` para o diretório `.vscode` da raiz do projeto e altere o endereço  `https://dev.remote.address.com` para a URL válida do projeto.

Um teste passa quando não produz nenhuma saída. Sempre que um teste imprimir algo ele é considerado falho.
