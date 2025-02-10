import { THexAddress } from "@/types/THexAddress"
import AddressUtils from "@/utils/AddressUtils"
import ClipboardUtils from "@/utils/ClipboardUtils"
import NumberUtils from "@/utils/NumberUtils"

export default function TokenRow({tokenName, tokenSymbol, amount, contractAddress, imgUrl, showSeparator = true, setSnackbarMessage} : IProps){

    async function handleCopyToClipboard(text : string) : Promise<void> {
        await ClipboardUtils.copy(text)
        setSnackbarMessage(Date.now() + "::Address copied to Clipboard.")
    }

    return(
        <div className="w-full flex flex-col">
            <div className="flex flex-row h-[68px] w-full">
                <img alt="token icon" src={imgUrl}/>
                <div className="flex flex-col ml-[14px] justify-center">
                    <span className="font-semibold translate-y-[0px] text-[#474b55]">{tokenName}</span>
                    <span onClick={() => handleCopyToClipboard(contractAddress)} title={contractAddress} className="cursor-copy hover:underline translate-y-[1px] text-[#92949Cdd] hover:bg-[#e8ebed]">{AddressUtils.maskAddress(contractAddress as THexAddress)}</span>
                </div>
                <div className="flex flex-col text-right ml-auto justify-center">
                    <span className="font-semibold text-[16px] leading-[22px] font-oswald translate-y-[-2px] text-[#BCC2C8]">{tokenSymbol}</span>
                    <span title={amount.toString()} className="translate-y-[2px] text-[#474b55] font-medium">{ typeof amount == 'bigint' ? (amount > 1000000n ? NumberUtils.formatNumber(amount) : amount) : amount }</span>
                </div>
            </div>
            {showSeparator && <div className="h-[1px] w-full border-b-[1px] border-dashed border-[#BCBEBEDD]"></div>}
        </div>
    )
}

interface IProps{
    tokenName : string
    tokenSymbol : string
    amount : bigint | 'n/a'
    contractAddress : string
    imgUrl : string
    showSeparator? : boolean
    setSnackbarMessage : React.Dispatch<React.SetStateAction<string | null>>
}