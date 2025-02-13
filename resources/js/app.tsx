import { createRoot } from 'react-dom/client'
import { createInertiaApp } from '@inertiajs/react'
import { ServicesProvider } from './context/ServicesContext'
import { EtherClientsProvider } from './context/EtherClientsContext'
import { SnackbarProvider } from './hooks/useSnackbar'
import DashboardLayout from './Layouts/DashboardLayout'
import { WagmiProvider } from 'wagmi'
import { config } from './Config/WalletConfig'
import { QueryClient, QueryClientProvider } from '@tanstack/react-query'

export type Page<T = {}> = React.FC<T> & {
  layout?: (page: React.ReactNode) => React.ReactElement;
}

const queryClient = new QueryClient()

createInertiaApp({
  resolve: name => { // persistent layout
    const pages = import.meta.glob('./Pages/**/*.tsx', { eager: true }) as Record<string, { default: Page }>
    const page = pages[`./Pages/${name}.tsx`]
    if (page.default.layout === undefined) {
      page.default.layout = (page: React.ReactNode) => <DashboardLayout>{page}</DashboardLayout>;
    }
    return pages[`./Pages/${name}.tsx`]
  },
  setup({ el, App, props }) {
    createRoot(el).render(
      <WagmiProvider config={config}>
        <QueryClientProvider client={queryClient}> 
            <EtherClientsProvider>
              <ServicesProvider>
                <SnackbarProvider>
                  <App {...props} />
                </SnackbarProvider>
              </ServicesProvider>
            </EtherClientsProvider>
        </QueryClientProvider>
      </WagmiProvider>
    )
  },
})