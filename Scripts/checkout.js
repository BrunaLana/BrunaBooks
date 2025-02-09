function fillAddressFields(addressJson) {
    if (addressJson) {
        const address = JSON.parse(addressJson);
        document.getElementById('moradaId').value = address.moradaId;
        document.getElementById('nomeMorada').value = address.nomeMorada;
        document.getElementById('morada').value = address.morada;
        document.getElementById('numero').value = address.numeroMorada;
        document.getElementById('complemento').value = address.complementoMorada;
        document.getElementById('freguesia').value = address.freguesiaMorada;
        document.getElementById('conselho').value = address.conselhoMorada;
        document.getElementById('distrito').value = address.distritoMorada;
        document.getElementById('codigoPostal').value = address.cpMorada;
        document.getElementById('pais').value = address.paisMorada;
    } else {
        document.getElementById('moradaId').value = '';
        document.getElementById('nomeMorada').value = '';
        document.getElementById('morada').value = '';
        document.getElementById('numero').value = '';
        document.getElementById('complemento').value = '';
        document.getElementById('freguesia').value = '';
        document.getElementById('conselho').value = '';
        document.getElementById('distrito').value = '';
        document.getElementById('codigoPostal').value = '';
        document.getElementById('pais').value = '';
    }
}