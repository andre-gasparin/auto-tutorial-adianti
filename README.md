# Criando um tutorial automático para seu usuário
> Um gerador automático para um tutorial automático com e para Adianti Framework utilizando a biblioteca driver.js.

<p align="center">
<img src="https://img.shields.io/badge/VERSÃO-1.0.0-green">
<img src="https://img.shields.io/badge/Licença-GNU 3.0-success">
<img src="https://img.shields.io/badge/PHP-Adianti-blue">
<img src="https://img.shields.io/badge/PHP->7.2-blueviolet">
</p>

<img src="https://raw.githubusercontent.com/andre-gasparin/auto-tutorial-adianti/main/assets/auto-tutorial.gif">

Link driver.js:
https://github.com/kamranahmedse/driver.js?ref=producthunt

## Instalação


Para instalar no Adianti Builder, vá na aba de "composer packages" e adicione:
```html
andregasparin/autotutorial
```

É necessário que você tenha o composer instalado.

Abra seu cmd (prompt), com o comando "cd c:/pasta/do/projeto" navegue até a raiz do seu projeto em adianti.

Execute o seguinte comando (podem variar no caso de usar linux ou mac, ex utilizar sudo no início):

```html
composer require andregasparin/autotutorial
```

## Utilização
Em todas páginas que você utilizar o auto-tutorial no inicio você adiciona a linha:
```html
use AndreGasparin\AutoTutorial\AutoTutorial;
```
Adicione metodo (ou no controller) para iniciar o tutorial, ex:
<pre>
public function onTutorial()
{
    $tutorial  = new AutoTutorial();
    $step[] =[
        'selector' => 'login',
        'selector_type' => 'name',  // id, class, name (padrão do adianti), *
        'title' => 'Campo de login',        
        'description' => 'Preencha o campo login',
        'position' => 'left-top',   // position can be left, left-center, left-bottom, top,
                                    // top-center, top-right, right, right-center, right-bottom,
                                    // bottom, bottom-center, bottom-right, mid-center
    ];
    $step[] =[
        'selector' => 'name',
        'selector_type' => 'name',
        'title' => 'Campo de nome',
        'description' => 'Preencha o campo nome',
        'position' => 'left-top', 
        'onNextPage' => 'index.php?class=LoginForm',  // carrega outra página depois da etapa
    ];
    $tutorial->setStepsArray($step);
    $tutorial->run(); //debug: true
}
</pre>

## Configuração para Desenvolvimento

Caso queira implementar algo no sistema, utilize os padrões do Adianti Framework, ficaremos felizes com sua participação!

## Precisa de melhoria ou ajuda com algum BUG?

<a href="https://github.com/andre-gasparin/auto-tutorial-adianti/issues">Issues</a>


## Histórico (ChangeLog)

* 1.0.0
    * Projeto criado
* 1.1.0
    * Pacote composer criado
## Meta

André Gasparin – [@andre-gasparin] – andre@gasparimsat.com.br / andre.gasparin@hotmail.com

Distribuído sob a Licença Pública Geral GNU (GPLv3) 


## Contributing

1. Faça o _fork_ do projeto (<https://github.com/andre-gasparin/auto-tutorial-adianti/fork>)
2. Crie uma _branch_ para sua modificação (`git checkout -b feature/fooBar`)
3. Faça o _commit_ (`git commit -am 'Add some fooBar'`)
4. _Push_ (`git push origin feature/fooBar`)
5. Crie um novo _Pull Request_
