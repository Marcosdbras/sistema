/*
 
 Localiza cep 
 
 */

function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.

    if (document.getElementById('rua') !== null) {
        document.getElementById('rua').value = ("");
    } else if (document.getElementById('rua2') !== null) {
        document.getElementById('rua2').value = ("");
    }

    if (document.getElementById('bairro') !== null) {
        document.getElementById('bairro').value = ("");
    } else if (document.getElementById('bairro2') !== null) {
        document.getElementById('bairro2').value = ("");
    }


    if (document.getElementById('cidade') !== null) {
        document.getElementById('cidade').value = ("");
    } else if (document.getElementById('cidade2') !== null) {
        document.getElementById('cidade2').value = ("");
    }

    if (document.getElementById('uf') !== null) {
        document.getElementById('uf').value = ("");
    } else if (document.getElementById('estado') !== null) {
        document.getElementById('estado').value = ("");
    } else if (document.getElementById('uf2') !== null) {
        document.getElementById('uf2').value = ("");
    }

    if (document.getElementById('ibge') !== null) {
        document.getElementById('ibge').value = ("");
    } else if (document.getElementById('ibge2') !== null) {
        document.getElementById('ibge2').value = ("");
    }
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        if (document.getElementById('rua') !== null) {
            document.getElementById('rua').value = (conteudo.logradouro);
        } else if (document.getElementById('rua2') !== null) {
            document.getElementById('rua2').value = (conteudo.logradouro);
        }

        if (document.getElementById('bairro') !== null) {
            document.getElementById('bairro').value = (conteudo.bairro);
        } else if (document.getElementById('bairro2') !== null) {
            document.getElementById('bairro2').value = (conteudo.bairro);
        }

        if (document.getElementById('cidade') !== null) {
            document.getElementById('cidade').value = (conteudo.localidade);
        } else if (document.getElementById('cidade2') !== null) {
            document.getElementById('cidade2').value = (conteudo.localidade);
        }

        if (document.getElementById('uf') !== null) {
            document.getElementById('uf').value = (conteudo.uf);
        } else if (document.getElementById('estado') !== null) {
            document.getElementById('estado').value = (conteudo.uf);
        } else if (document.getElementById('uf2') !== null) {
            document.getElementById('uf2').value = (conteudo.uf);
        }

        if (document.getElementById('ibge') !== null) {
            document.getElementById('ibge').value = (conteudo.ibge);
        } else if (document.getElementById('ibge2') !== null) {
            document.getElementById('ibge2').value = (conteudo.ibge);
        }


    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            if (document.getElementById('rua') !== null) {
                document.getElementById('rua').value = "...";
            } else if (document.getElementById('rua2') !== null) {
                document.getElementById('rua2').value = "...";
            }

            if (document.getElementById('bairro') !== null) {
                document.getElementById('bairro').value = "...";
            } else if (document.getElementById('bairro2') !== null) {
                document.getElementById('bairro2').value = "...";
            }


            if (document.getElementById('cidade') !== null) {
                document.getElementById('cidade').value = "...";
            } else if (document.getElementById('cidade2') !== null) {
                document.getElementById('cidade2').value = "...";
            }

            if (document.getElementById('uf') !== null) {
                document.getElementById('uf').value = "...";
            } else if (document.getElementById('estado') !== null) {
                document.getElementById('estado').value = "...";
            } else if (document.getElementById('uf2') !== null) {
                document.getElementById('uf2').value = "...";
            }
            
            if (document.getElementById('ibge') !== null) {
            document.getElementById('ibge').value = "...";
        }else if (document.getElementById('ibge2') !== null) {
           document.getElementById('ibge2').value = "..."; 
        }
            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
}
;


