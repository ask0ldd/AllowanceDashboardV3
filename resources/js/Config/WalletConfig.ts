import { http, createConfig } from 'wagmi'
import { holesky } from 'wagmi/chains'
import { injected, metaMask, safe } from 'wagmi/connectors'

const projectId = 'Revoke Allowance Prj'

export const config = createConfig({
  chains: [holesky],
  connectors: [
    injected(),
    /*walletConnect({ projectId }),*/
    metaMask(),
    safe(),
  ],
  transports: {
    [holesky.id]: http(),
  },
})