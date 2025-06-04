<?php

namespace App\Http\Controllers;

use App\Models\Export;
use Illuminate\Http\Request;

class ExportarConsumoController extends Controller
{
    /**
     * Método principal que gera e faz download do arquivo CSV
     * Ele acessa a rota /exportar-consumos
     */
    public function exportarExcel()
    {
        // Busca os dados do consumo e forma um array
        $dados = Export::dadosConsumos();
        
        // Converte o array de dados para o formato CSV
        // Chama o método privado que faz toda a formatação
        $csvContent = $this->arrayToCsv($dados);
        
        // Define os cabeçalhos HTTP para forçar o download do arquivo
        $headers = [
            // Informa ao navegador que é um arquivo CSV
            'Content-Type' => 'text/csv',
            
            // Força o download e define o nome do arquivo
            'Content-Disposition' => 'attachment; filename="relatorio_consumos.csv"',
            
            // Impede que o navegador use cache (sempre baixa arquivo novo)
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            
            // Define que o arquivo expira imediatamente (não fica em cache)
            'Expires' => '0',
            
            // Informa que é conteúdo público (pode ser baixado)
            'Pragma' => 'public',
        ];
        
        // Retorna a resposta HTTP com o conteúdo CSV e os cabeçalhos
        // Status 200 = sucesso, iniciará o download automaticamente
        return response($csvContent, 200, $headers);
    }
    
    /**
     * Método privado que converte um array de dados para formato CSV
     * @param array $data - Array com os dados a serem convertidos
     * @return string - Conteúdo formatado em CSV
     */
    private function arrayToCsv($data)
    {
        // Verifica se há dados para processar
        // Se não houver, retorna string vazia
        if (empty($data)) {
            return '';
        }
        
        // Variável que vai armazenar todo o conteúdo CSV
        $output = '';
        
        // === CRIAÇÃO DOS CABEÇALHOS ===
        // Pega as chaves do primeiro elemento como cabeçalhos da planilha
        // Ex: ['Empresa ID', 'Fonte de Consumo', 'Quantidade Consumida', 'Data de Referência']
        $headers = array_keys($data[0]);
        
        // Junta os cabeçalhos com ponto e vírgula e adiciona quebra de linha
        // Ponto e vírgula é o separador padrão do Excel brasileiro
        $output .= implode(';', $headers) . "\n";
        
        // === PROCESSAMENTO DOS DADOS ===
        // Percorre cada linha de dados
        foreach ($data as $row) {
            // Array temporário para armazenar os valores tratados da linha atual
            $csvRow = [];
            
            // Percorre cada valor da linha atual
            foreach ($row as $value) {
                // === TRATAMENTO DE CARACTERES ESPECIAIS ===
                // Substitui aspas duplas por duas aspas duplas (padrão CSV)
                // Ex: João "Silva" vira João ""Silva""
                $value = str_replace('"', '""', $value);
                
                // Verifica se o valor contém caracteres que precisam de aspas
                // Se contém ponto e vírgula, aspas ou quebra de linha
                if (strpos($value, ';') !== false || strpos($value, '"') !== false || strpos($value, "\n") !== false) {
                    // Envolve o valor inteiro em aspas duplas 
                    $value = '"' . $value . '"';
                }
                
                // Adiciona o valor tratado ao array da linha
                $csvRow[] = $value;
            }
            
            // Junta todos os valores da linha com ponto e vírgula
            // Adiciona quebra de linha no final
            $output .= implode(';', $csvRow) . "\n";
        }
        
        // Retorna todo o conteúdo CSV formatado
        return $output;
    }
}