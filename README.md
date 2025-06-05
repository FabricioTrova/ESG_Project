🌱 Sistema de Gestão ESG - DashCarbon
📖 Descrição
Este sistema tem como objetivo gerenciar dados relacionados ao consumo de recursos pelas empresas, possibilitando o cálculo da pegada de carbono e a análise de indicadores ESG (Environmental, Social, and Governance). A solução permite o cadastro de empresas, usuários, fontes de consumo, registros de consumo e a geração automatizada de análises de carbono, com visualização via dashboards.

🗂️ Modelagem do Banco de Dados
1. Tabela: empresas
id: Identificador único.

nome: Nome da empresa.

cnpj: CNPJ (único).

setor_atividade: Setor de atuação.

endereco: Endereço completo.

data_cadastro: Data e hora do cadastro.

2. Tabela: usuarios
id: Identificador único.

nome: Nome completo.

email: Email (único).

senha_hash: Senha criptografada.

empresa_id: Referência à empresa.

tipo_usuario: admin | gestor | colaborador.

data_cadastro: Data e hora do cadastro.

3. Tabela: fontes_consumo
id: Identificador único.

nome: Exemplo: Água, Energia Elétrica.

unidade_medida: Exemplo: m³, kWh.

fator_emissao: Fator de emissão (gCO2e/unidade).

4. Tabela: consumos
id: Identificador único.

empresa_id: Referência à empresa.

fonte_consumo_id: Referência à fonte.

data_referencia: Data de referência.

quantidade_consumida: Quantidade consumida.

data_registro: Data e hora do registro.

5. Tabela: analises_carbono
id: Identificador único.

empresa_id: Referência à empresa.

data_referencia: Data da análise.

emissao_total_kgco2e: Emissão total em kgCO2e.

detalhes_json: Detalhes por fonte.

data_calculo: Data e hora do cálculo.

🔁 Fluxo do Sistema
Cadastro da Empresa
→ realizado internamente pela equipe de gestão.

Cadastro de Usuários
→ realizado por administradores.

Cadastro de Fontes de Consumo
→ realizado por administradores ou gestores.

Cadastro de Dados de Consumo
→ realizado por gestores ou colaboradores.

Geração da Análise de Carbono
→ realizada automaticamente pelo sistema ou manualmente.

Visualização em Dashboards
→ disponível conforme permissões do usuário.

🚀 Funcionalidades
✅ Cadastro de Empresas
CNPJ único.

Dados completos.

Realizado exclusivamente pela equipe interna.

✅ Cadastro de Usuários
Vinculado à empresa.

Tipos: admin, gestor, colaborador.

Controle de acesso baseado no tipo de usuário.

✅ Cadastro de Fontes de Consumo
Nome, unidade e fator de emissão.

Gerenciado por administradores e gestores.

✅ Registro de Consumos
Seleção de fonte e data.

Quantidade consumida.

Origem do dado (manual ou API).

✅ Cálculo da Análise de Carbono
Multiplicação da quantidade consumida pelo fator de emissão.

Armazena resultado consolidado e detalhado.

Exemplo de detalhes_json:

json
Copy
Edit
{
  "Energia elétrica": "1200 kgCO2e",
  "Água": "300 kgCO2e"
}
✅ Visualização de Dashboards
Emissões por fonte.

Evolução temporal.

Comparativos entre empresas (apenas admins).

Filtros por período.

👤 Controle de Acesso
Funcionalidade	Admin	Gestor	Colaborador
Cadastro de Empresas	✅	❌	❌
Cadastro de Usuários	✅	❌	❌
Cadastro de Fontes de Consumo	✅	✅	❌
Cadastro de Consumos	✅	✅	✅
Cálculo da Análise de Carbono	✅	✅	❌ (visualização apenas)
Visualização de Dashboards	✅	✅	✅
Edição de Perfil	✅ (todos)	✅ (própria empresa)	✅ (próprio)

🖥️ Telas Implementadas
Cadastro de Usuários

Cadastro de Fontes de Consumo

Cadastro de Consumos

Cálculo e Visualização da Análise de Carbono

Dashboards interativos

Perfil e edição de usuários

🛠️ Tecnologias Utilizadas
Backend: Laravel (PHP) ou Node.js

Banco de Dados: PostgreSQL

Frontend: HTML, CSS, Bootstrap, SB Admin 2

Gráficos: Chart.js / ApexCharts

Autenticação: Criptografia de senha, autenticação por roles

📝 Como Usar
Clonar o repositório.

Configurar o banco de dados PostgreSQL com as tabelas indicadas.

Definir variáveis de ambiente (.env).

Executar as migrations e seeders se disponíveis.

Rodar o servidor.

Acessar a aplicação via navegador.

⚙️ Requisitos
PHP >= 8.0 ou Node.js >= 16.x

PostgreSQL >= 12.x

Composer / npm

🎯 Futuras Melhorias
Integração completa via API para entrada automatizada de consumos.

Notificações sobre metas e limites de emissões.

Exportação de relatórios em PDF.

Análises preditivas com machine learning.

