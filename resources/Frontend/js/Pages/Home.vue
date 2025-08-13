<template>
    <section>
        <JPicture src="/assets/images/banner.png" class="w-full h-full" />
    </section>
    <section id="about" class="py-[48px] bg-banner-blue bg-cover">
        <div class="container space-y-[48px]">
            <div class="text-center gradient-primary">
                <div class="font-display text-[24px] space-x-[8px]">
                    <span class="text-[24px]">Nơi nhịp sống</span>
                    <span class="text-[32px] font-semibold">Bình yên</span>
                </div>
                <div class="font-display text-[32px] space-x-[8px]">
                    <span class="font-semibold text-[48px]">Gặp gỡ</span> <span>Tâm điểm phồn vinh</span>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-[64px]">
                <div class="col-span-full md:col-span-1 flex items-center">
                    <div class="space-y-[32px]">
                        <div class="flex items-center space-x-[20px]">
                            <svg
                                width="41"
                                height="60"
                                viewBox="0 0 41 60"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                            >
                                <rect width="41" height="59" transform="translate(0 0.96582)" fill="#1849A9" />
                                <rect x="4" y="4.96582" width="33" height="51" fill="url(#pattern0_9992_892)" />
                                <defs>
                                    <pattern
                                        id="pattern0_9992_892"
                                        patternContentUnits="objectBoundingBox"
                                        width="1"
                                        height="1"
                                    >
                                        <use
                                            xlink:href="#image0_9992_892"
                                            transform="matrix(0.0115125 0 0 0.00744927 -2.37813 -0.0588235)"
                                        />
                                    </pattern>
                                    <image
                                        id="image0_9992_892"
                                        width="500"
                                        height="229"
                                        preserveAspectRatio="none"
                                        xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAfQAAADlCAYAAAClKwUAAAAgAElEQVR4Ae2dW3BVVbrvrX7oF19OV/V+2nUe+nH7hm99qnyyusvqY2vj1u3pbk/b7bEbSkV20SBiKyc2Nq2AgFy2hg4KgkEISjiRkIhAkIgEwiWSC7C4GghqBBFolXAZp34j+cLMdM615rola5F/qgbzPi6/OVn/8X3jdsst+hMBERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERCB0iRw/vz5H51oefMnbKOCc+5f8g1R8WZ7Lt885Pq85dOe57g036RyJQIiIAIiMKoJfJVqfORiT2ONc262c9dmDg2cc7PdtWvzcgo+zoE4huyH07HjqHtjzkXlyblXXL4hGO+QPPt8vHL5wsm/u4qKH4zqj0aFFwEREAERKD0Cu14fv/f4tmp39WKXu9y7zwf2CX2XTl6//l23u9531gfXd8nlGiwO4iNeSyPbLc8O5iuQN+LPNW/ZPHfx3BknQS+971g5EgEREIFRT+DjxX+q3zb3D651yRM+7F050XVWT3GdNRWuo+4Fd2zDfHe88b/csabXHcL/afOawdD98TqXKXA/zx1vWtEfz4b5LrV+to+fNHxapFc9xQ2mPXAcvObvHcgTz5OvIXlrWjEkX6d21bkzre8NCT17NjoC520/m+2X+xvcuX3vdYz6j0YAREAEREAESo8Agt68YLyzsPPVCW5n5SS3+41pbv/K6e5AzUzXWTvXHaxf6A43VLrUpiofjmxZ7pIE7uc5nice4iNe4ieQVrpg91l+Pln1/GCewvmy/PgKBJWIbdXuRPPavEKwAvP57nXui9baztJ7i8qRCIiACIjAqCeAoHsRHxByE3OEE6sYaxgLndC9ucqd2r7Mh9M7ql04mPgFz2OZY90f2bLEx0F8ZqGn1kwbYqEHLXKu+etY8QP5MMs8mB/iJ0+W5mctq50FBDifgPcBS9+8ELLQR/1/FwEQAREQgdIlEBb0vVWTXPuycfN6Gqbd0fHujLssXNn92s8KFYg7l3Byy7I7ee57+ThQ8/MrFsin7ee4PX+w9n7i6Gx4ZSlWvom6BL10v2PlTAREQARGPYGgoCPmbcunuvbacbeNejC33HJLqv7lMd4DsKvOi7oEXV+FCIiACIhAyRKIEvRdVY/dVbIZHqaM0ZMdj4BZ6FjpEvRhgq9kREAEREAEsicgQY9ndnjrkrsl6PF8dEUEREAERKCECEjQ41/GkaaVY3G5M7RNFno8J10RAREQAREoAQIS9PiXgKAzFE6CHs9IV0RABERABEqEQFDQ6RBHUBt6/8uRhV4iH6myIQIiIAIikJmABD2ekQQ9no2uiIAIiIAIlBgBCXr8C4kTdM3lHs9MV0RABERABEaIgAQ9HrwEPZ6NroiACIiACJQYAQl6/AuRoMez0RUREAEREIESIxAl6NsXjR9bYtkckexI0EcEuxIVAREQARHIhYAEPZ6aF/Rt1UOGrX25771DakOPZ6YrIiACIiACI0RAgh4PXoIez0ZXREAEREAESozAoKBX9i/Mwjh0udz7X5IEvcQ+VmVHBERABEQgnsCgoL86wU8qI0G/wUqCfoOF9kRABERABEqcwKCgy0L/3psKC/rZ9k1Obejfw6QTIiACIiACpUBAgh7/FiTo8Wx0RQREQAREoMQIFFvQ6RF+ouXNn5w/f/5HxQ6k0/bm5FsLhViCXiiSikcEREAERKDoBIot6D1dH6y5eO6M6+v7tnc4wqXeU58h7IUAFxT0M63vObncC0FVcYiACIiACBSFQDEFHev85EfV2y6cPuhc3yV3+dK5ogbSuHC0xfUca7ujELAk6IWgqDhEQAREQASGhUAxBZ0CIOifNq9xUeFE81p/Przt/nids3Ph545vq3Y+NK1wrFWe2lTlDjdUuoP1C92p7cvc8cb/cqn6l8cUAp4EvRAUFYcIiIAIiMCwEBgOQTeBRqT9/o71XrBPsE0Xmtf23zewNTFHyINiLkEflk9FiYiACIiACJQygeESdITchP2zltXu893rEgfuJ5zeUe2tcCzx7s1V3hrHMid01s71545tmC8LvZQ/OOVNBERABESgOARGQtAPNy569qvUjjFn9y7/aa4Bt/rJLcvubF01q1eCXpxvQ7GKgAiIgAiUEYHhEnTc7fQUxzIvVC90MH9SM7Md6/xAzcz+9vP1s2Whl9H3p6yKgAiIgAgUiMBwCvqX+xscAcu6QNn3go6YS9ALRVTxiIAIiIAIlCUBL+iVk9zOgalf96+cXtDFWejlbm3niDkWerEE3befy0Ivy+9QmRYBERABEciTgAn63qpJDjH/ZNXzZSXoB6qfbSPPWOgS9Dw/Bj0uAiIgAiJQvgRM0He/Mc2LeWdNRVkKOqIuQS/f71A5FwEREAERyJPAnqUT6xFzgrVFt7z1xAN5Rjv4eLFd7mahS9AHkWtHBERABERgNBIwQcfdnqL9ef1sV2xBP7x1yd2FYi1BLxRJxSMCIiACIlDWBBB0aztHzHFbF1PQmSBGgl7Wn4wyLwIiIAIiUIoE9lQ/1RDsVMZc6F0b59xXqLyGXe4S9EKRVTwiIAIiIAIiECCAoNN2zuQsiHmhBf3oB0s327A1JpZh+lZZ6IEXoF0REAEREAERKASB9toZjYg506cyPzqhGBY6C6swBp2tBL0Qb05xiIAIiIAIiECAAIKOmLNi2fGmFX7xk0IKOhY6074OCnrTirIU9FO76vwsd1/ue+8Q67wHEGpXBERABERABEaeAIKOmLOuOKuYEQot6KxpTmWB9nM8AOVooUvQR/5bVQ5EQAREQATSEEDQEXMC7duEYgg665cTN4Le8e6Mu9JkKatLwzVsTYKe1WvRzSIgAiIgAsNN4GDDwgbE3AS30J3WcLnjbrf46XRXVoLetML17NnoJOjD/WUqPREQAREQgawIDJegm0u/GIIeHEfPWPr22nG3ZQUh5uYjTSvH0lQQFPRz+97rUBt6DDCdFgEREAERGDkCCDrWM8JlLvdCtnGbhT4cgs6kOKfr/uoO1VX8uBBEz+5d/tMoQS9E3IpDBERABERABApKYLgFHdEttMsdC51A+/zl3n3uq1TjIyda3vzJxZN7bwuGvt7O25MGnu/es3YKlRzc7eZyx0Iv6AtQZCIgAiIgAiJQCALDJej0pEdwiyXobcun+rid+6fj7+rVK0OCP5nFPzzvXJ+vIDAxDoH13CXohfjqFIcIiIAIiEDBCSDox5peL67LnbHnRRZ0pq8lUGm4cLRlaDh90F3INRxt8WIuC73gn54iFAEREAERKCSBYRF0ZocbBkFnClsTdpvO1sbY0xbuw7Zq58fFb6v2k93YftSWc0yKI5d7Ib84xSUCIiACIlAUAsPici+ihb7v7SePWBu6LTJjU9nacDyGzSHMJ3aszyqYkNtWLveifIKKVAREQAREoBAETNBtnHhRxqEXUdC7aiev6XjnqTOpumcOEbo2zO8ipDYt7Tq1vepQT0u1D1+01nZaoB08Kth1pndln0oAbecS9EJ8aYpDBERABESgqATKXdAZE84wtfY1FT9k30IQmp2zbfAa+3aeLfG0vTn5VraH358zHutegh4mpmMREAEREIGSI2CCTse4oo1DL6KFXkygjEOPGraG8BczXcUtAiIgAiIgAlkTkKDHIzu5ZdmdEvR4ProiAiIgAiJQQgRM0K0NndXWCj5TXJla6Ah62OWu5VNL6ONVVkRABERABG4Q6Bf0Jc5c7sVYPpXhYsUatnajJIXf83O5h9rQJeiF56wYRUAEREAECkDABP3IliVFWw8d678cBR1PRdhCp/e72tAL8OEpChEQAREQgcISQNAZr22LpzDTWqHXQy9XC90LetMK38vdpn6VoBf2+1NsIiACIiACBSJggm4WNMubFlPQWd60kIuzFAhDZDS43PEuMGxNgh6JSCdFQAREQARKhUB77YxGxPxg/UKHmHtBr/3LLwuVP5ZPDbrcJeiFIqt4REAEREAERCBAAEFHzE3QWQ2tS4LuCclCD3wo2hUBERABEShtAgg6c58TsJ4JEvT+dyZBL+1vV7kTAREQAREIEEDQWZmMgJizlaD3A5KgBz4U7YqACIiACJQ2gT3VTzUMWXK0pkKCPvDKJOil/e0qdyIgAiIgAgECCHpw+VHEfVfVY3cFbslrV53i8sKnh0VABERABEQgGYE9SyfW735jmiMg7G3Lp0rQB9AxDl3D1pJ9R7pLBERABERghAmYoO+snOTFXIJ+44Ug6EyJe2LHej8O/Uzre04Ty9zgoz0REAEREIESIoCgI+bFFnSGxTELHb3pC+nSLyZKmymOSWUIEvRi0lbcIiACIiACeRH4ePGf6ne+OsER9lb1W+mFFFxrQzdBZ5x7qv7lMXllepgeJp9MiSsLfZiAKxkREAEREIHcCUQJ+vZF48fmHuPQJxF0RBHLnJXcLvfucxc/3z+9r7fzdkLPsbY7CHYc3Nq1kdh+ldoxpnvP2imfNq/5nqAPLaGOREAEREAERKAECCDozQvGD7HQiyHoWOhY51cvdrmrV6+UTbhw+qDzot68dtDlXgKvTVkQAREQAREQgaEEwoKO270Ygs588VjpCPvpHdXeWqdNPSpgyRO477OW1e7z3et8+HJ/gzvbvmlIuHC0xRUzkN6J5rU+WBv6UII6EgEREAEREIESIGCCjpWOmBdb0BnnTk960rG2++C2dckTg235DKPjfmavozJgFQIqB7bkK8PKLLBMa9qwrbr/Ottg4Lngse0PnA93iiuB16YsiIAIiIAIiMBQAk1zf9+ImBdL0FOblnYhsggw1jmijEAj1Dbu3Sa2iRLwoHh7sd5W7V3guMFNaNNtWfrUOrVxX3DfnrPlUTmO2re0ZKEP/XZ0JAIiIAIiUEIEii3op7a+NK911axewic1M9sPVD/b1rpsakdc4DqBey10bZjfFQxUEoYjHN22uMfEHLGXoJfQh6usiIAIiIAIDCVQTEF3FRU/IOyY+7t/bXtz8q3tayp+aMGuRW3tnkJuo9LhXFQa5BVKXRvn3MfEMog5wi5BH/rt6EgEREAERKCECBRT0EuomINZQcTtILgfde7klmV3BgWdznnMFGf3aisCIiACIiACJUNgtAl6NuBN0OnljoVugh5VEcgmXt0rAiIgAiIgAgUnIEGPR8rUr3TmM5c7gt7TUn1Igh7PTFdEQAREQARGiIAEPR4866FL0OP56IoIiIAIiEAJEZCgx78ME/Sgy10WejwvXREBERABERhBAkFBZ1IXQiFnihvBouWdNL3csdAl6HmjVAQiIAIiIALFJiBBjycsQY9noysiIAIiIAIlRiAo6EzHKgv9xgtC0JmpThb6DSbaEwEREAERKFECQUG3edTlcu9/WSboDFljrnf1ci/Rj1jZEgEREAERuOUWCXr8VyBBj2ejKyIgAiIgAiVGICzocrnfeEES9BsstCcCIiACIlDiBMKCXujlU0u8+GmzFxZ01mbXsLW0yHRRBERABERgpAgg6Nvm/sEvn4p1Lgv9xpuQoN9goT0REAEREIESJyBBj39BEvR4NroiAiIgAiJQYgQk6PEvRIIez0ZXREAEREAESoxAUNB3vjrBEZpfvvcXJZbNEcmOCTpD1o43rXBqQx+R16BERUAEREAEkhAIC3pn9RS3edZDtyd59ma/B0E/WL/Qj0GXoN/sb1vlEwEREIEyJ2CCTse41gUPu4vH17nLF07+/UpP2x3nT7Xdf/mbb/6j3EL7moofFuK1SNALQVFxiIAIiIAIDAsBE/TmBeNd84u/8W5l13fJEa73nfXBH7t/Ole00Jdd3IG8WR7Zkr/LvfvcV6kdYwoBT4JeCIqKQwREQAREYFgIDBF0RH3BeIfb/XTdX92nW2e6E1vnuZMfVV7vblnuxf5c13LX2/HOsAXarUn71PZlrntzlc8PeTq2Yb7PI/m0wPnUmmkuVf9y0QT91PaqQ66i4gfD8nKUiAiIgAiIgAgkJRAWdN8pbsF4t7Nyktv9xjS3f+V098mq592Bmpmus3au66qfPRhoX+aYbbaBRU94xrbB50mHQJoE0icfBPJE3nygA99AJYRt2/KpvjLSXjvutqTlT3df2EI/vaPaSdDTEdM1ERABERCBESOAoAdFEUFHNE3MTciDgosIE1grnHBky5LBEHWO63be7rfj4LWguIdFPSjoQ0TdxH2gAoKoS9BH7HNSwiIgAiIgAiNFICjoftha5STXumxqx6er/7y0q3bympMbZ9YEw9ntr6wqdgimxz55SRKOrXq85mh9xfy2NyffWgiegxZ60wp3rOl1Jwu9EFQVhwiIgAiIQFEImKAj5szjjoW7q+qxu4qSWB6R0m493G3XEvQ8XpgeFQEREAERGF4CCLq3zF+d4MUc13YpCvrwUulPTYI+EtSVpgiIgAiIQE4EPl78p3pztSPmnTUVEvQBkhL0nD4pPSQCIiACIjASBLygD3QoQ8wJXbV/+eVI5KXU0pSgl9obUX5EQAREQARiCexZOrHeerR31L3gCBL0flwIOsPy6BCnTnGxn5AuiIAIiIAIlAIBBB1XO2O9U+tnu8ONsyToAy8mKOgMr+uf4EYTy5TCd6s8iIAIiIAIhAjsqX6qwSaOQcwl6DcASdBvsNCeCIiACIhAiRNA0Jk8Blf7kc0LfJDLvf+lhQWd6Wc1U1yJf9DKngiIgAiMVgLttTMafbt5/WwJeugjkKCHgOhQBERABESgdAmEBZ0FTmSh978vCXrpfrfKmQiIgAiIQIgAgm4LriDmEvQbgCToN1hoTwREQAREoMQJSNDjX5AEPZ6NroiACIiACJQYAQTderfTKU4W+o0XZIJuq8mpU9wNNtoTAREQAREoMQJmoSPqEvShL0eCPpSHjkRABERABEqYgAk67ehqQx/6osKCfvKjyusatjaUkY5EQAREQARKhIC53CXo338hQwR98wInl/v3GemMCIiACIhAiRAICjoud1zvHe/OKLn10EcCF8P3qOj4NvQBQT/dvLhtJPKiNEVABERABEQgLYGgoONy/3LPQpeqf3lM2odGyUU4+Bn0tizx/Quw0CXoo+Tlq5giIAIiUG4Egm3oWOfXv+t2fd/0br584eTfCc652c5dm3lzBcoUCteuzXOBQNm/u9D9LguyHKxf6AWdNnQJerl94cqvCIiACIwSAibo3tVe94K7eHydc+6frv+vb2Cf4xxD3yXn+i65631nh4bvun3lgQpEwcNAWqQ7NN+UJ2mAQJ/79swm3wxBc4QEfZT8p1AxRUAERKAcCQQFnfbiVMPzvrc74pU0sFa43Wv7trX2ZwSR+HFht73zlGtbPtXtXTnR7a2a5FqXPJFXIA4CcXZWT3GdNRX967rb/PRblvj1zHGZY3EnDdwfzL8EvRy/cOVZBERABEYJgaCgY6Wb6CK8HXXPeWHs3+c4cxj6/AteXFmelTXXd78xze18dYJrXjDebZv7Bx82v/hbR3h/xq+zCvZccEucxE0aOysn+fRI11aTI//kL5tg7nZZ6KPkP4SKKQIiIALlSuCTmpntWOWIuQk6gmfHdi54HLVvPeS5Ftw3gcdqNlHHIg8Luwl8LltE3AJCjrVOWlQkTMSDwkz+cg1Hty3uKdd3rXyLgAiIgAjcxAQOvz9nfGfDK0uP1lfMjwqntr40L58QjDP1zuSZhPZl4+YRdi16eE4hg8Vr22Da+ZTBnoUTvG7iz0FFEwEREAERKHcCrqLiB8Uuw3CkkW0ZyFNUyDYe3S8CIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACIiACw0TAVVT8oH1NxQ/ZDlOSBU2GvBMKGmlEZIfqKn4ccVqnREAEREAERGBkCCDcV3ra7rj4+f7p3V0fHjp7Ym937+lDX7Dt+6Z3s7t2bd7lb775j77ezttN5E+0vPmTr1KNj5w/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rF7ELE50wgDSDVUL3kuP77gff9qa4yxB8oHLnB/rYHxe0J+7z7u1ueYXmFk2tYO8E6ikWOex4HO2T7zcY8fhLR6HuDzZvYyZxvWNkBPoGZ9OMMgP+YyyPokTgcYjkq7DFmXFcxLVjGD5ymZLfLjP22tnNFo5KBPn0sVDHukpH1dhSvcs1+L4Ex8M8GaE40h3LXgvZcLDcLp5cRtlYovnxCaaCd6rfREQARG46Qnwo5ipkAgT1nmcQNnzSeKye5NuTdDNkiMNC0njyPe+YpQrXZ5Ij/LSLyBXIY2Kf7jLEZWHpOeG+x0nzZfuEwEREIGyJsDkLCO1YllY0MsaZBaZp+0/UwfELKLTrSIgAiIgAqOdAILqV2nLcaawfPmRPq5ns9Dzja8cnscTEjeTXDnkX3kUAREQAREoQQJ0Pko37rzYWaY9GjHPp2NYsfNY6Phxs0eNwS50OopPBERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABERABESguAT+P4BWoSjkboiEAAAAAElFTkSuQmCC"
                                    />
                                </defs>
                            </svg>

                            <div class="text-[48px] text-[#1849A9] font-display">Giới thiệu</div>
                        </div>
                        <div>
                            Nếu mỗi thành phố là một bản hòa tấu phát triển, thì SYMLIFE chính là nốt nhạc vang lên tại
                            tâm điểm giao hòa giữa các mạch sống lớn tại trung tâm phát triển chiến lược phía Đông Bắc
                            TPHCM.
                        </div>
                        <div>
                            Với SYMLIFE – thanh âm giao hòa không chỉ là âm sắc của vị trí, mà còn là nhịp đập chung của
                            một vùng đất đang chuyển mình mạnh mẽ - nơi mọi nhịp sống đều dễ dàng kết nối, và giá trị
                            sống đang từng ngày gia tăng
                        </div>
                    </div>
                </div>
                <div class="col-span-full md:col-span-2">
                    <JPicture src="/assets/images/banner2.png" class="w-full h-full" />
                </div>
            </div>
        </div>
    </section>
    <section>
        <JPicture src="/assets/images/tongquan.png" class="w-full h-full" />
    </section>
    <section>
        <JPicture src="/assets/images/symlife.png" class="w-full h-full" />
    </section>

    <Resone :slides="resone" />
    <section>
        <JPicture src="/assets/images/matbang.png" class="w-full h-full" />
    </section>
    <Benefit :slides="resone" />
    <Premises />
    <SliderCom />
    <Discover />

    <section id="lienhe">
        <div class="grid grid-cols-12">
            <!-- Form bên trái -->
            <div
                class="col-span-12 md:col-span-5 bg-cover bg-center bg-bg-10 p-8 text-gray-300 flex items-center w-full"
            >
                <div class="w-full">
                    <h2 class="font-display font-medium uppercase mb-6 text-[48px] text-[#B2DDFF]">
                        Kết nối <br />
                        với chúng tôi
                    </h2>

                    <form class="space-y-6">
                        <input
                            type="text"
                            placeholder="Họ và tên"
                            class="w-full bg-transparent border-b border-white/50 focus:border-white outline-none py-2"
                        />

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <input
                                type="text"
                                placeholder="Số điện thoại"
                                class="w-full bg-transparent border-b border-white/50 focus:border-white outline-none py-2"
                            />
                            <input
                                type="email"
                                placeholder="Email"
                                class="w-full bg-transparent border-b border-white/50 focus:border-white outline-none py-2"
                            />
                        </div>

                        <textarea
                            placeholder="Lời nhắn"
                            rows="3"
                            class="w-full bg-transparent border-b border-white/50 focus:border-white outline-none py-2 resize-none"
                        ></textarea>

                        <button
                            type="submit"
                            class="w-full py-3 rounded bg-blue-gradient hover:opacity-90 transition uppercase label-1"
                        >
                            Gửi thông tin
                        </button>
                    </form>
                </div>
            </div>

            <!-- Ảnh bên phải -->
            <div class="col-span-12 md:col-span-7">
                <JPicture src="assets/images/Frame 21.png" alt="Tòa nhà" class="w-full h-full object-cover" />
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            resone: [
                '/assets/images/reson/Asset 1 1.png',
                '/assets/images/reson/Asset 1 2.png',
                '/assets/images/reson/Asset 1 3.png',
            ],
        }
    },
}
</script>

<style>
</style>