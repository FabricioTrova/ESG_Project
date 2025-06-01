$(document).ready(function() {
    // Inicializa o DataTable com idioma PT-BR
    $('#dataTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
        }
    });

    // Evento de clique para o botão Editar
     $(document).on('click', '.edit-btn', function () {
        console.log('Botão Editar clicado');
        var id = $(this).data('id');
        var nome = $(this).data('nome');
        var cnpj = $(this).data('cnpj');
        var setor = $(this).data('setor');
        var endereco = $(this).data('endereco');

        console.log('Dados capturados:', { id, nome, cnpj, setor, endereco });

        abrirModalEdicao(id, nome, cnpj, setor, endereco);
    });

    // Função para abrir modal com dados para edição
    function abrirModalEdicao(id, nome, cnpj, setor, endereco) {
        console.log('Abrindo modal com dados:', { id, nome, cnpj, setor, endereco });

        $('#empresa_id').val(id);
        $('#nome').val(nome);
        $('#cnpj').val(cnpj);
        $('#setor_atividade').val(setor);
        $('#endereco').val(endereco);

        $('#salvarBtn').hide();
        $('#editarBtn').show();
        $('#empresaModalLabel').text('Editar Empresa');

         $('#empresaForm').attr('action', urlEmpresas + '/' + id); // usa a variável JS
        $('#empresaForm').find('input[name="_method"]').val('PUT');

        $('#empresaModal').modal('show');
    }

    // Resetar modal ao fechar
    $('#empresaModal').on('hidden.bs.modal', function () {
        $('#empresaForm')[0].reset();
        $('#empresa_id').val('');
        $('#salvarBtn').show();
        $('#editarBtn').hide();
        $('#empresaModalLabel').text('Adicionar Empresa');
        $('#empresaForm').attr('action', urlEmpresasStore); // usa a variável JS
        $('#empresaForm').find('input[name="_method"]').val('POST');
    });
});
