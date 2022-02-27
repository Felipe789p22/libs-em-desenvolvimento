# libs-em-desenvolvimento
Biblioteca responsável por calcular termos de uma PA e PG

Ela verifica de acordo com o define (TERMO_PA ou TERMO_PG) se a sequência informada no construtor da classe se trata de uma Progressão aritmética ou Progressão Geométrica

Segue abaixo exemplo bem simples.

Como parâmetro no construtor da classe deve ser informado a sequência de números como um array.

$objeto = new Progressao([0, 1, 2, 3, 4,5]);
$tipoProgressao = $objeto->processar(TERMO_PA);
$tipo = TERMO_PA;
$verificarTipo = $tipo == 1 ? "PA" : "PG";
if ($tipoProgressao == 1) {
    echo "É uma " . $verificarTipo;
} else {
    echo "Não é uma " . $verificarTipo;
}
