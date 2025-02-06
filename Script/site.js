function fillAddressFields(addressJson) {
    if (addressJson) {
        const address = JSON.parse(addressJson);
        document.getElementById('morada').value = address.morada;
        document.getElementById('numero').value = address.numero;
        document.getElementById('complemento').value = address.complemento;
        document.getElementById('freguesia').value = address.freguesia;
        document.getElementById('conselho').value = address.conselho;
        document.getElementById('distrito').value = address.distrito;
        document.getElementById('codigoPostal').value = address.codigoPostal;
        document.getElementById('pais').value = address.pais;
    } else {
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