import { http, createConfig } from 'wagmi'
import { base, holesky, optimism } from 'wagmi/chains'
import { injected, metaMask, safe, walletConnect } from 'wagmi/connectors'

const projectId = 'Revoke Allowance Prj'

export const config = createConfig({
  chains: [holesky, base],
  connectors: [
    injected(),
    walletConnect({ projectId }),
    metaMask(),
    safe(),
  ],
  transports: {
    [holesky.id]: http(),
    [base.id]: http(),
  },
})