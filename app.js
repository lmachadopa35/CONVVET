// Configuração do Firebase
const firebaseConfig = {
    apiKey: "AIzaSyCsC9IMPwStRJRk8UkV8eVvbM45L_6-CQQ",
    authDomain: "convenio-pet.firebaseapp.com",
    databaseURL: "https://convenio-pet-default-rtdb.firebaseio.com",
    projectId: "convenio-pet",
    storageBucket: "convenio-pet.appspot.com",
    messagingSenderId: "714806579015",
    appId: "1:714806579015:web:03977905207c3f9b428662",
    measurementId: "G-G09NXS97VG"
};

// Inicializa o Firebase
firebase.initializeApp(firebaseConfig);

// Referência do banco de dados
const database = firebase.database();

// Função genérica para verificar duplicidades
async function checkDuplicate(path, key, value) {
    const ref = database.ref(path);
    const query = ref.orderByChild(key).equalTo(value);
    const snapshot = await query.once('value');
    return snapshot.exists();
}

// Função para login do usuário
function login(event) {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Busca os dados no Firebase
    const userRef = database.ref('users/' + username);
    userRef.once('value', (snapshot) => {
        if (snapshot.exists() && snapshot.val().password === password) {
            alert('Login realizado com sucesso!');
            // Aqui você pode redirecionar para outra página ou site
            // window.location = 'https://example.com';
        } else {
            alert('Usuário e/ou senha incorreta(s)');
        }
    }).catch((error) => {
        alert('Erro no login: ' + error.message);
    });
}

// Função para cadastrar clínica
async function registerClinic(event) {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const clinicName = document.getElementById('clinicName').value;
    const address = document.getElementById('address').value;
    const phone = document.getElementById('phone');
    const commercialEmail = document.getElementById('commercialEmail');

    // Aplicar máscara ao telefone
    const phoneMask = IMask(phone, {
        mask: '(00) 0 0000-0000',
        lazy: false // Aplica a máscara enquanto o usuário digita
    });

    // Aplicar máscara ao e-mail
    const emailMask = IMask(commercialEmail, {
        mask: /^\S+@\S+\.\S+$/,
        lazy: true // Aplica a máscara ao sair do campo
    });

    const cnpj = document.getElementById('cnpj').value;

    // Verifica duplicidade
    if (await checkDuplicate('clinics', 'username', username) ||
        await checkDuplicate('clinics', 'commercialEmail', commercialEmail.value) ||
        await checkDuplicate('clinics', 'cnpj', cnpj)) {
        alert('Erro no cadastro: Usuário, Email ou CNPJ já cadastrado!');
        return;
    }

    // Adiciona os dados no Firebase
    const clinicRef = database.ref('clinics/' + username);
    clinicRef.set({
        clinicName: clinicName,
        address: address,
        phone: phoneMask.unmaskedValue, // Salva o valor sem a máscara
        commercialEmail: commercialEmail.value,
        cnpj: cnpj
    }).then(() => {
        alert('Cadastro realizado com sucesso!');
    }).catch(error => {
        alert('Erro no cadastro: ' + error.message);
    });
}

// Adiciona eventos aos formulários
document.getElementById('loginForm').addEventListener('submit', login);
document.getElementById('clinicForm').addEventListener('submit', registerClinic);
