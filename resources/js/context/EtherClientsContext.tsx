import React, { createContext, useState, ReactNode, useRef } from 'react';
import { createPublicClient, http, PublicClient } from 'viem';
import { holesky } from 'viem/chains';

/*
* Stores the public and the wallet clients
*/
interface EtherClientsContextType {
  publicClient: PublicClient | null
  setPublicClient: (client: PublicClient) => void
  addressRef : React.RefObject<`0x${string}` | null>
}

export const EtherClientsContext = createContext<EtherClientsContextType | undefined>(undefined)

export const EtherClientsProvider: React.FC<{ children: ReactNode }> = ({ children }) => {
    const [publicClient, setPublicClient] = useState<PublicClient | null>(getPublicClient ?? null)
    const addressRef = useRef<`0x${string}` | null>(null)

    function getPublicClient(){
        return createPublicClient({
            chain: holesky,
            transport: http('https://ethereum-holesky.publicnode.com')
        })
    }

    return (
        <EtherClientsContext.Provider value={{ publicClient, setPublicClient, addressRef }}>
        {children}
        </EtherClientsContext.Provider>
    )
}