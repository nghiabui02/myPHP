// Authorization token that must have been created previously. See : https://developer.spotify.com/documentation/web-api/concepts/authorization
const token = 'BQCEinTrTxqVX5OWduCQ4Fm48yVHyJFBzw0LPGFHOJJ_BSNsvIynfWJR-wY91_5avckjE72BHZNhl-p88gSpE74z70iVc-NPLbA5wkhej8EZ76A4oNQzJKS7wXHBmSHKAFjWWlQUD63Mm_bNyh6PddfYF69r5e1Dckr5UZg73p1_QAhAB-sPxpLZZxYPBr2r1QuO7jcYhX_dJpKTefTix5tFLCS4KsRQUPJRXRf5MoAVBz1UM-ajCwuuRC7TjKnKiQUEgZtfd_HpAVtBmwCRpp_d';
async function fetchWebApi(endpoint, method, body) {
    const res = await fetch(`https://api.spotify.com/${endpoint}`, {
        headers: {
            Authorization: `Bearer ${token}`,
        },
        method,
        body:JSON.stringify(body)
    });
    return await res.json();
}

async function getTopTracks(){
    // Endpoint reference : https://developer.spotify.com/documentation/web-api/reference/get-users-top-artists-and-tracks
    return (await fetchWebApi(
        'v1/me/top/tracks?time_range=long_term&limit=5', 'GET'
    )).items;
}

const topTracks = await getTopTracks();
console.log(
    topTracks?.map(
        ({name, artists}) =>
            `${name} by ${artists.map(artist => artist.name).join(', ')}`
    )
);
