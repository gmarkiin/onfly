import { useQuasar } from 'quasar'
export default function useNotify () {
  const $quasar = useQuasar()
  const notifySucess = (message) => {
    $quasar.notify({
      type: 'positive',
      position: 'center',
      message: message || 'Sucess!'
    })
  }
  const notifyError = (message) => {
    $quasar.notify({
      type: 'negative',
      position: 'center',
      message: message || 'Failed Request'
    })
  }
  return {
    notifySucess,
    notifyError
  }
}
