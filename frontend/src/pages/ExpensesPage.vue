<template>
  <q-page>
    <div class="row justify-center">
      <q-table
        :rows="expenses"
        :columns="columns"
        row-key="id"
        class="col-8"
      >
        <template v-slot:top>
          <span class="text-h6">
            Expenses
          </span>
          <q-space/>
          <q-btn label="add new" icon= "mdi-plus" color="primary" :to="{ name: 'form-expenses' }"/>
        </template>
        <template v-slot:body-cell-actions="props">
          <q-td :props="props" class="q-gutter-x-sm">
            <q-btn icon="mdi-pencil-outline" color="info" dense @click="handleEdit(props.row)">
              <q-tooltip>
                Edit
              </q-tooltip>
            </q-btn>
            <q-btn icon="mdi-delete-outline" color="negative" dense @click="handleRemoveExpense(props.row)">
              <q-tooltip>
                Delete
              </q-tooltip>
            </q-btn>
          </q-td>
        </template>
      </q-table>
    </div>
  </q-page>
</template>

<script>
const columns = [
  { name: 'description', align: 'left', field: 'description', label: 'Description' },
  { name: 'value', align: 'left', field: 'value', label: 'Value' },
  { name: 'expense_date', align: 'left', field: 'expense_date', label: 'Expense Date' },
  { name: 'actions', align: 'right', field: 'actions', label: 'Actions' }
]

import { defineComponent, ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import useApi from 'src/helpers/UseApi'
import useNotify from 'src/helpers/UseNotify'
export default defineComponent({
  name: 'ExpensesPage',
  setup () {
    const router = useRouter()

    const expenses = ref([])
    const loading = ref(true)

    const { listExpense, removeExpense } = useApi()
    const { notifyError, notifySucess } = useNotify()
    const handleListExpenses = async () => {
      try {
        expenses.value = await listExpense()
        loading.value = false
      } catch (error) {
        notifyError(error.message)
      }
    }
    const handleEdit = (expense) => {
      router.push({ name: 'form-expenses', params: { id: expense.id } })
    }
    const handleRemoveExpense = async (expense) => {
      try {
        await removeExpense(expense.id)
        notifySucess('Expense deleted with sucess!')
        await handleListExpenses()
      } catch (error) {
        notifyError(error.message)
      }
    }

    onMounted(() => {
      handleListExpenses()
    })

    return {
      columns, expenses, handleEdit, handleRemoveExpense
    }
  }
})
</script>

<script setup>
</script>
