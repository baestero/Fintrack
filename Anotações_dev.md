# Fintrack

- layout

## JUNHO / 2026 [<] [>]

💰 Receber: R$ 5.300
💸 Pagar: R$ 2.320
🟢 Saldo: R$ 2.980

---

Progresso
Recebido ████████░░ 70%
Pago ██████░░░░ 55%

---

A PAGAR
[ ] Aluguel R$1500 10/06
[ ] Internet R$120 15/06
[ ] Mercado R$700 20/06

A RECEBER
[✓] Salário R$5000 05/06
[ ] João R$300 18/06

---

# Login

- Na teoria eu implementei a mesma lógica de login don projeto Tripway, somente com algumas mudanças na interface e redirecionamento

# Migrations

- Agora na criação das migrations foi definido que essas aplicação terá 3 tabelas contando a de usuários.

- cake bake migrations nome_da_migration (singular)
- cake migrations migrate (para executar criação das tabelas no banco)
    - Users
        - hasMany `meses`
    - Meses
        - belongsTo `Users`
        - hasMany `Lançamentos`
    - Lancamentos
        - belongsTo `Users` (opicional) pois um mes ja pertece a um usuário
        - belongsTo `Meses`

# Controllers

- Como nesse projeto não vai ser uma implementação de um CRUD simpes, vou criar os controllers e views manualmente.

---
