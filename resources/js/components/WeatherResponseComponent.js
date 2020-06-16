class WeatherResponseComponent extends React.Component {

    constructor(props) {
        super(props);
    }

    render() {

        const weatherResponse = this.props.weatherResponse;

        const showTable = weatherResponse.length > 0;

        return <table style={{ display: showTable ? "block" : "none" }} className="h-full w-full">
            <thead className="h-full w-full">
            <tr className="w-full">
                <th className="px-4 py-2">Date</th>
                <th className="px-4 py-2">Max Temp (c)</th>
            </tr>
            </thead>
            <tbody className="h-full w-full">
            {weatherResponse.map(response => (
                <tr key={response.date} className="w-full">
                    <td  className="border px-4 py-2">{response.date}</td>
                    <td  className="border px-4 py-2">{response.maxTemp}</td>
                </tr>
            ))}
            </tbody>
        </table>
    }
}

export default WeatherResponseComponent
